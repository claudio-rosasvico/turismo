// Importá el CSS desde el JS para que Vite lo empaquete
import '../css/chatbase.css';

function mountChatbase(root) {
  const name   = root.dataset.chatbase || 'chatbase';
  const toggle = root.querySelector('.chatbase-toggle');
  const panel  = root.querySelector('.chatbase-corner');
  const btnClose = root.querySelector('.btn-close');
  const btnMin   = root.querySelector('.js-chatbase-min');

  if (!toggle || !panel) return;

  const open = () => {
    panel.classList.remove('d-none', 'minimized');
    // fuerza reflow para transición
    // eslint-disable-next-line no-unused-expressions
    panel.offsetHeight;
    panel.classList.add('show');
    toggle.setAttribute('aria-expanded', 'true');
    toggle.setAttribute('aria-label', 'Cerrar chat');
  };

  const close = () => {
    panel.classList.remove('show');
    setTimeout(() => panel.classList.add('d-none'), 200);
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Abrir chat');
  };

  const minimize = () => {
    if (panel.classList.contains('minimized')) {
      panel.classList.remove('minimized');
      return;
    }
    panel.classList.add('minimized');
  };

  toggle.addEventListener('click', () => {
    if (panel.classList.contains('d-none')) open(); else close();
  });
  btnClose?.addEventListener('click', close);
  btnMin?.addEventListener('click', minimize);

  // ESC para cerrar
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && panel.classList.contains('show')) close();
  });

  // Hooks opcionales (útiles con Livewire)
  window.addEventListener(`chat:${name}:open`, open);
  window.addEventListener(`chat:${name}:close`, close);
  window.addEventListener(`chat:${name}:minimize`, minimize);
}

// auto-mount al cargar
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.chatbase-root').forEach(mountChatbase);
});
