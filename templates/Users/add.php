<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $profiles
 */
?>
<div class="page-body">
    <div class="container-xl">

        <!-- Botón para volver -->
        <div class="mb-3">
            <?= $this->Html->link(
                '← ' . __('Back to list'),
                ['action' => 'index'],
                ['class' => 'btn btn-outline-secondary']
            ) ?>
        </div>

        <!-- Formulario dentro de tarjeta -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Add User') ?></h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($user, ['class' => 'row g-3']) ?>

                <div class="col-md-6">
                    <?= $this->Form->control('email', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('password', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('name', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('phone', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('profile_id', [
                        'options' => $profiles,
                        'empty' => true,
                        'class' => 'form-select'
                    ]) ?>
                </div>

                <div class="col-12 mt-3">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
