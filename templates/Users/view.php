<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="page-body">
    <div class="container-xl">
        <!-- Botón para volver atrás -->
        <div class="mb-3">
            <?= $this->Html->link(
                '← ' . __('Back to list'),
                ['action' => 'index'],
                ['class' => 'btn btn-outline-secondary']
            ) ?>
        </div>

        <!-- Card con la info del usuario -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= h($user->name) ?></h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-bordered mb-0">
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($user->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Phone') ?></th>
                        <td><?= h($user->phone) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Profile') ?></th>
                        <td>
                            <?= $user->hasValue('profile') ?
                                $this->Html->link($user->profile->role, ['controller' => 'Profiles', 'action' => 'view', $user->profile->id])
                                : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
