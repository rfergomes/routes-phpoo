<?php

use app\support\Flash;

/*function flash(string $index, string $css = '')
{
    // if (isset($_SESSION[$index])) {
    $message = Flash::get($index);

    return "<span style='{$css}'>{$message}</span>";
    // }
}*/

function flash(string $index, string $mode = 'toast'): string
{
    $message = Flash::get($index); // Compatível com sua classe
    $type = $index === 'danger' ? 'error' : $index;

    // Define ícone baseado no tipo
    switch ($index) {
        case 'success':
            $ico = '#check-circle-fill';
            break;
        case 'warning':
        case 'danger':
            $ico = '#exclamation-triangle-fill';
            break;
        default:
            $ico = '#info-fill';
            break;
    }

    // Estrutura padrão
    $tipo = [
        'toast' => '',
        'alert' => '',
        'field' => ''
    ];

    if (!empty($message)) {
        // Toast → Salva mensagem para uso no footer
        if ($mode === 'toast') {
            $_SESSION['flash_toast'] = [
                'message' => $message,
                'type'    => $type // toastr expects: success, error, warning, info
            ];
        }

        // Alerta Bootstrap com ícone SVG
        $tipo['alert'] = '
        <div class="alert alert-' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . ' d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Ícone">
                <use xlink:href="' . $ico . '"></use>
            </svg>
            <div>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>';

        // Erro de campo
        $tipo['field'] = '<small class="form-text text-danger">
            <div class="error-message">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>
        </small>';
    }

    return $tipo[$mode] ?? '';
}

