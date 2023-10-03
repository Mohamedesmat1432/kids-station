<div x-data="{ open: false }" x-show="open"
    x-on:notify.window="Toastify({
    text: $event.detail.message,
    duration: 2000,
    newWindow: true,
    close: true,
    gravity: 'top', 
    position: 'right', 
    stopOnFocus: true,
    style: {
      background: ($event.detail.style == 'success') ? 'bg-indigo-600' : 'bg-danger-600',
      borderRaduis:'5px',
    },
  }).showToast();">

</div>
