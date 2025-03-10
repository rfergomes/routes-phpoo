$(document).ready(function () {
    const $userModal = $('#userModal');
    const $userForm = $('#userForm');
    const $alertContainer = $('#alerts-container');

    if ($userModal.length) {
        const modal = new bootstrap.Modal(document.getElementById('userModal'));

        $userModal.on('show.bs.modal', async function (event) {
            const button = $(event.relatedTarget);
            const recipient = button.data('bs-id') || null;

            // Selecionando os campos do modal
            const $modalHeaderTitle = $userModal.find('.modal-title');
            const $modalBodyId = $('#id');
            const $modalBodyName = $('#name');
            const $modalBodyEmail = $('#email');
            const $modalBodyUser = $('#username');
            const $modalBodyPassword = $('#password');
            const $modalBodyPhoto = $('#image');
            const $modalBodyPreview = $('#imagePreview');
            const $modalBodyType = $('#user_level');
            const $modalBodyStatus = $('#status');

            // Caminho padrão do avatar
            const defaultAvatar = '../assets/images/user/default-avatar.png';

            // Resetando o modal antes de carregar novos dados
            const clearFields = () => {
                $modalBodyId.val('');
                $modalBodyName.val('');
                $modalBodyEmail.val('');
                $modalBodyUser.val('');
                $modalBodyPassword.val('');
                $modalBodyType.val('2');
                $modalBodyStatus.val('1');

                if ($modalBodyPhoto.length) {
                    $modalBodyPhoto.val('');
                }

                if ($modalBodyPreview.length) {
                    $modalBodyPreview.attr('src', defaultAvatar);
                }

                // Limpar mensagens de erro
                $('.error-message').text('');
            };

            if (!recipient) {
                $modalHeaderTitle.text('Novo usuário');
                clearFields();
            } else {
                try {
                    const response = await fetch(`/user/getById/${recipient}`, { method: 'GET' });

                    if (!response.ok) {
                        const errorMessage = await response.text();
                        throw new Error(`Erro ${response.status}: ${errorMessage}`);
                    }

                    const data = await response.json();

                    $modalHeaderTitle.text(`Editar usuário ${data.name || 'Desconhecido'}`);
                    $modalBodyId.val(data.id || '');
                    $modalBodyName.val(data.name || '');
                    $modalBodyEmail.val(data.email || '');
                    $modalBodyUser.val(data.username || '');
                    $modalBodyPassword.val('');
                    $modalBodyType.val(data.user_level || '2');
                    $modalBodyStatus.val(data.status || '1');

                    if (data.image && data.image !== '') {
                        $modalBodyPreview.attr('src', `../assets/images/user/${data.image}`);
                    } else {
                        $modalBodyPreview.attr('src', defaultAvatar);
                    }

                } catch (error) {
                    console.error('Erro ao buscar os dados do usuário:', error);
                    alert('Erro ao carregar os dados do usuário. Tente novamente.');
                }
            }
        });

        $userModal.on('change', '#image', function () {
            const file = this.files[0];
            const $imagePreview = $('#imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $imagePreview.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $userModal.on('hidden.bs.modal', function () {
            const $modalBodyPhoto = $('#image');
            if ($modalBodyPhoto.length) {
                $modalBodyPhoto.val('');
            }
        });

        $userForm.on('submit', async function (event) {
            event.preventDefault();

            const formData = new FormData($userForm[0]);
            const formObject = {};

            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            // Para visualizar os dados do objeto no console
            console.log(formObject);

            try {
                const response = await fetch($userForm.attr('action'), {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formObject) // Converte o objeto para JSON
                });

                const result = await response.json();

                if (response.ok) {
                    if (result.error) {
                        // Exibir mensagens de erro nos campos correspondentes
                        for (const [field, message] of Object.entries(result.error)) {
                            $(`#error-${field}`).text(message);
                        }
                        showAlert('danger', 'Erro ao salvar usuário.');
                    } else {
                        showAlert('success', 'Usuário salvo com sucesso!');
                        $userForm[0].reset();
                    }
                } else {
                    let erros = '';

                    if (result.error && typeof result.error === 'object') {
                        // Exibir mensagens de erro nos campos correspondentes
                        for (const [field, message] of Object.entries(result.error)) {
                            $(`#error-${field}`).text(message);
                        }
                    } else {
                        erros = result.error || 'Erro ao salvar usuário.';
                    }

                    showAlert('danger', erros);
                }
            } catch (error) {
                console.log(error);
                showAlert('danger', 'Erro ao processar a requisição.');
            }
        });

        function showAlert(type, message) {
            $alertContainer.html(`
                <div class="alert alert-${type}" role="alert">
                    ${message}
                </div>
                
            `);

            setTimeout(() => {
                $alertContainer.empty();
                $(`#error-name`).text('');
                $(`#error-email`).text('');
                $(`#error-password`).text('');
            }, 3000);
        }
    }
});
