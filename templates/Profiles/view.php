<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profile $profile
 */
?>
<div class="page-body">
    <div class="container-xl">

        <!-- Encabezado con acciones -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <?= $this->Html->link(
                '← ' . __('Back to list'),
                ['action' => 'index'],
                ['class' => 'btn btn-outline-secondary']
            ) ?>
        </div>

        <!-- Card con datos del perfil -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><?= h($profile->role) ?></h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong><?= __('Role') ?>:</strong>
                        <div><?= h($profile->role) ?></div>
                    </div>
                    <div class="col-md-6">
                        <strong><?= __('Id') ?>:</strong>
                        <div><?= $this->Number->format($profile->id) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usuarios relacionados -->
        <?php if (!empty($profile->users)) : ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= __('Related Users') ?></h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Email') ?></th>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Phone') ?></th>
                                <th><?= __('Profile Id') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profile->users as $user) : ?>
                                <tr>
                                    <td><?= h($user->id) ?></td>
                                    <td><?= h($user->email) ?></td>
                                    <td><?= h($user->name) ?></td>
                                    <td><?= h($user->phone) ?></td>
                                    <td><?= h($user->profile_id) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
