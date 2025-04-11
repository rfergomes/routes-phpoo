<?php $this->layout('layout', ['title' => $title]) ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">    
                <iframe class="contact-map" loading="lazy" allowfullscreen src="https://maps.google.com/maps?q=sindicato+dos+quimicos+unificados&output=embed" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="row justify-content-center">
                    <div class="col-11 col-sm-9 col-xl-8">
                        <div class="card contact-card-form user-card">
                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <div class="flex-grow-1 me-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avtar bg-primary text-white me-3">
                                                <i class="ph-duotone ph-chats-teardrop f-26"></i>
                                            </div>
                                            <div>
                                                <h4 class="f-w-500 mb-1">Contate-nos</h4>
                                                <p class="mb-0">Vamos iniciar uma conversa</p>
                                            </div>
                                            <div class="float-end ms-auto">
                                                <?php echo flash('sent_success', 'color:green;') ?>
                                                <?php echo flash('sent_error', 'color:red') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="/contact" method="post">
                                    <div class="row">
                                        <?php echo getToken(); ?>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Nome</label>
                                                <input type="text" class="form-control" name="name" placeholder="Digite seu nome">
                                                <small id="file-error-msg" class="form-text text-danger">
                                                    <div class="error-message" id="bouncer-error_file"><?php echo flash('name') ?></div>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Assunto</label>
                                                <input type="text" class="form-control" name="subject" placeholder="Digite o assunto">
                                                <small id="file-error-msg" class="form-text text-danger">
                                                    <div class="error-message" id="bouncer-error_file"><?php echo flash('subject') ?></div>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">E-mail</label>
                                                <input type="email" class="form-control" name="email" placeholder="Digite seu E-mail">
                                                <small id="file-error-msg" class="form-text text-danger">
                                                    <div class="error-message" id="bouncer-error_file"><?php echo flash('email') ?></div>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Telefone</label>
                                                <input type="text" class="form-control" name="phone" placeholder="Digite seu telefone">
                                                <small id="file-error-msg" class="form-text text-danger">
                                                    <div class="error-message" id="bouncer-error_file"><?php echo flash('phone') ?></div>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Mensagem</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Escreva sua mensagem"></textarea>
                                                <small id="file-error-msg" class="form-text text-danger">
                                                    <div class="error-message" id="bouncer-error_file"><?php echo flash('message') ?></div>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="d-grid mt-3">
                                            <button type="submit" class="btn btn-primary mx-sm-3 mx-md-5">Enviar Mensagem</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>