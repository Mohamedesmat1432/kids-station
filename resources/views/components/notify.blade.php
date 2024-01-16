<div x-data="{ open: false }" x-show="open"
    x-on:notify.window="Toastify({
    text: $event.detail.message,
    duration: 3000,
    newWindow: true,
    close: true,
    gravity: 'top', 
    position: 'right', 
    stopOnFocus: true,
    style: {
      background: ($event.detail.style === 'success') ? 'bg-indigo-600' : 'bg-red-600',
      borderRaduis:'5px',
    },
  }).showToast();">

</div>
