document.getElementById("toggleButton").addEventListener("click", function () {
    const inputField = document.getElementById("toggleInput");
    if (inputField.style.display === "none" || inputField.style.display === "") {
        inputField.style.display = "block"; 
        inputField.focus(); 
    } else {
        inputField.style.display = "none"; 
    }
});


const $menu = $('.menu-toggle')

const onMouseUp = e => {
 if (!$menu.is(e.target) 
   && $menu.has(e.target).length === 0) 
   {
     $menu.removeClass('is-active')
  }
}

$('.toggle').on('click', () => {
  $menu.toggleClass('is-active').promise().done(() => {
    if ($menu.hasClass('is-active')) {
      $(document).on('mouseup', onMouseUp) 
    } else {
      $(document).off('mouseup', onMouseUp) 
    }
  })
})
