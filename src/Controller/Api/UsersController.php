<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Http\Exception\UnauthorizedException;

class UsersController extends AppController
{
    protected $currentUser = null;

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $authHeader = $this->request->getHeaderLine('Authorization');

        if (strpos($authHeader, 'Basic ') === 0) {
            $encodedCredentials = substr($authHeader, 6);
            $decodedCredentials = base64_decode($encodedCredentials);

            if ($decodedCredentials !== false && strpos($decodedCredentials, ':') !== false) {
                list($email, $password) = explode(':', $decodedCredentials, 2);
                $usersTable = $this->fetchTable('Users');

                $user = $usersTable->find()
                    ->contain(['Profiles'])
                    ->where(['email' => $email])
                    ->first();

                if ($user && password_verify($password, $user->password)) {
                    $this->currentUser = $user;
                    return;
                }
            }
        }

        if (!$this->currentUser) {
            $this->response = $this->response->withStatus(401)
                ->withHeader('WWW-Authenticate', 'Basic realm="API"')
                ->withType('application/json')
                ->withStringBody(json_encode(['error' => 'Unauthorized']));
            return $this->response;
        }

        throw new UnauthorizedException('Unauthorized');
    }

    public function index()
    {
        $users = $this->Users->find('all')->contain(['Profiles'])->all();
        $this->response = $this->response->withType('application/json')->withStringBody(json_encode($users));
        return $this->response;
    }

    public function add()
    {
        $this->request->allowMethod(['post']);

        $user = $this->Users->newEmptyEntity();

        $data = $this->request->getData();

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $user = $this->Users->patchEntity($user, $data);

        if ($this->Users->save($user)) {
            $response = [
                'message' => 'User created.',
                'user_id' => $user->id
            ];
            $status = 201;
        } else {
            $response = [
                'error' => 'User could not be created.',
                'errors' => $user->getErrors()
            ];
            $status = 400;
        }

        return $this->response->withStatus($status)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'put']);

        $user = $this->Users->get($id);

        $data = $this->request->getData();

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        $user = $this->Users->patchEntity($user, $data);

        if ($this->Users->save($user)) {
            $response = [
                'message' => 'User updated.'
            ];
            $status = 200;
        } else {
            $response = [
                'error' => 'User could not be updated.',
                'errors' => $user->getErrors()
            ];
            $status = 400;
        }

        return $this->response->withStatus($status)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);

        $userRole = $this->currentUser->profile->role ?? 'user';

        if ($userRole !== 'admin') {
            $this->response = $this->response->withStatus(403)
                ->withType('application/json')
                ->withStringBody(json_encode(['error' => 'Forbidden']));
            return $this->response;
        }

        $usersTable = $this->fetchTable('Users');

        $user = $usersTable->get($id);

        if ($usersTable->delete($user)) {
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode(['message' => 'User deleted.']));
        } else {
            $this->response = $this->response->withStatus(500)
                ->withType('application/json')
                ->withStringBody(json_encode(['error' => 'User could not be deleted.']));
        }

        return $this->response;
    }
}
