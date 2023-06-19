let seats = document.querySelectorAll('.fast a');

seats.forEach(function(seat){
    seat.addEventListener('click', function(){
        seat.classList.toggle('selected'); 
    });
});