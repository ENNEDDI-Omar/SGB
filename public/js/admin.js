let aside = document.querySelector(".navigation");
let menu = document.querySelector("#remove");
let content = document.querySelector(".content");
let header = document.querySelector(".tit");
let head = document.querySelector(".head");


menu.onclick = () => {
    aside.classList.toggle('remv');
    menu.classList.toggle('bxs-chevron-right');
    content.classList.toggle('left');
    head.classList.toggle('left');
    header.classList.toggle('titleft');
}


const ctx = document.getElementById('Chart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' , 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      datasets: [{
        label: '# Views',
        data: [120, 1900, 300, 550, 220, 350 , 200 , 100 , 500 , 10 , 1000],
        borderWidth: 3 ,
        backgroundColor : 'blueViolet',
        borderColor : 'blueViolet',
        tension: 0.3,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

const ctx1 = document.getElementById('lineChart');

  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' , 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      datasets: [{
        label: '# Views',
        data: [120, 1900, 300, 550, 220, 350 , 200 , 100 , 500 , 10 , 1000],
        borderWidth: 3 ,
        backgroundColor : 'blueViolet',
        borderColor : 'blueViolet',
        tension: 0.3,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctx2 = document.getElementById('doughnut');

  new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: [
            'Red',
            'Blue',
            'Yellow'
          ],
          datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
              'blueViolet',
              'red',
              'green'
            ],
            hoverOffset: 4
          }]
    },
  });


  