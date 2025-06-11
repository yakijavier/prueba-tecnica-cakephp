<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profile $profile
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

        <!-- Formulario en tarjeta -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('Add Profile') ?></h3>
            </div>
            <div class="card-body">
                <?= $this->Form->create($profile, ['class' => 'row g-3']) ?>

                <div class="col-md-6">
                    <?= $this->Form->control('role', ['class' => 'form-control']) ?>
                </div>

                <div class="col-12 mt-3">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
