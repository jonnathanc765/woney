
  class SiemaWithDots extends Siema {

    addDots() {
      this.dots = document.createElement('div');
      this.dots.classList.add('dots');
      this.dots.classList.add('row');

      for(let i = 0; i < this.innerElements.length; i++) {
        const dot = document.createElement('button');
        dot.classList.add('dots__item');
        dot.addEventListener('click', () => {
          this.goTo(i);
        })
        this.dots.appendChild(dot);
      }
      this.selector.parentNode.insertBefore(this.dots, this.selector.nextSibling);
    }

    updateDots() {
      for(let i = 0; i < this.dots.querySelectorAll('button').length; i++) {
        const addOrRemove = this.currentSlide === i ? 'add' : 'remove';
        this.dots.querySelectorAll('button')[i].classList[addOrRemove]('dots__item--active');
      }
    }
  }


    const slider = new SiemaWithDots({
      selector: '.siema-slider',
      onInit: function(){
        this.addDots();
        this.updateDots();
      },
      onChange: function(){
        this.updateDots()
      },
      duration: 200,
      easing: 'ease-out',
      loop: true
    });

    M.AutoInit();

    var scroll = new SmoothScroll('a[href*="#"]');


    $('.send-mail').click(function () {

      verifyForm();
      
    });

    function verifyForm() {

      $('form .message').fadeOut();
      
      elements = $('form textarea, form input');

      for (element of elements) {
        if ($(element).val().trim() == "") {
          alert('Debe llenar todos los campos correctamente');
          return;
        }
      }
      sendMail();
    }

    function sendMail () {

      $('form .progress').fadeIn();
      $('form button').attr('disabled');

      $.ajax({
        data: {
          name: $('#name').val(),
          phone: $('#phone').val(),
          email: $('#email').val(),
          country: $('#country').val(),
          message: $('#message').val(),
        },
        method: "POST",
        url: "sendmail.php",
      }).then(function(response) {
        
        $('form .progress').fadeOut();
        $('form button').removeAttr('disabled');

        $('form .message').text('Mensaje enviado exitosamente');
        $('form .message').fadeIn();
      })
      .catch(function (err) {
        $('form button').removeAttr('disabled');

        $('form .message').text('No se ha podido enviar tu mensaje');
        $('form .progress').fadeOut();
      });

    }
