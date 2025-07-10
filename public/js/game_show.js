$('#videoCarousel').on('slide.bs.carousel', function () {
    var currentSlide = $(this).find('.carousel-item.active video')[0];
    if (currentSlide) {
      currentSlide.pause();
    }
  });

  $('video').on('play', function () {
    var carousel = $(this).closest('.carousel');
    carousel.carousel('pause');
  });

  $('video').on('pause ended', function () {
    var carousel = $(this).closest('.carousel');
    carousel.carousel('cycle');
  });

  function scrollContainer(scrollAmount) {
    const container = document.getElementById('scrollContainer');
    const newPosition = container.scrollLeft + scrollAmount;
    container.scrollTo({ left: newPosition, behavior: 'smooth' });
  }