window.onload = function() {
  var date = new Date();
  var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
  var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

  document.getElementById('date').setAttribute('min', formatDate(firstDay));
  document.getElementById('date').setAttribute('max', formatDate(lastDay));

  document.getElementById('date').onchange = function() {
      var selectedDate = new Date(this.value);
      if (selectedDate.getDay() == 0 || selectedDate.getDay() == 6) {
          alert('Please select a weekday');
          this.value = '';
      } else {
          fetchBookings();
      }
  }
}

function formatDate(date) {
  var dd = String(date.getDate()).padStart(2, '0');
  var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = date.getFullYear();

  return yyyy + '-' + mm + '-' + dd;
}
