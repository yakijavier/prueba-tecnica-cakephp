<?php
$this->disableAutoLayout();
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <?= $this->Html->css('tabler.min') ?>
    <style>
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f5f7fb;
      }
    </style>
  </head>
  <body>
    <div class="page page-center">
      <div class="container-tight py-4">
        <?= $this->Form->create(null, ['class' => 'card card-md']) ?>
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>

            <?= $this->Form->control('email', [
                'label' => 'Email address',
                'type' => 'email',
                'class' => 'form-control mb-3',
                'placeholder' => 'your@email.com',
                'required' => true
            ]) ?>

            <?= $this->Form->control('password', [
                'label' => 'Password',
                'type' => 'password',
                'class' => 'form-control mb-3',
                'placeholder' => 'Your password',
                'required' => true
            ]) ?>

            <div style="color: red">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>

            <div class="form-footer">
              <?= $this->Form->button('Sign in', ['class' => 'btn btn-primary w-100']) ?>
            </div>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>

    <?= $this->Html->script('tabler.min') ?>
  </body>
</html>
