
  M.AutoInit();

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

  const services = new SiemaWithDots({
    selector: '.siema-services',
    onInit: function () {
      this.addDots();
      this.updateDots();
    },
    onChange: function () {
      this.updateDots
    },
  });


