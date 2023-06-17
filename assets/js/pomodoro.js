//The js file is adapted from https://freshman.tech/pomodoro-timer/
//(Source: https://github.com/Freshman-tech/pomodoro-starter-files retrieved in March 2022)

var t1=document.getElementById("t1").value;
var t2=document.getElementById("t2").value;
var t3=document.getElementById("t3").value;
var t4=document.getElementById("t4").value;
//var test1=document.getElementById("test1").value;
//var test2=document.getElementById("test2").value;
//var test3=document.getElementById("test3").value;

timer = {
  pomodoro: t1,
  shortBreak: t2,
  longBreak: t3,
  longBreakInterval: t4,
  sessions: 0,
};

let interval;

const buttonSound = new Audio('button-sound.mp3');
const mainButton = document.getElementById('js-btn');
mainButton.addEventListener('click', () => {
  buttonSound.play();
  const { action } = mainButton.dataset;
  if (action === 'start') {
    startTimer();
  } else {
    stopTimer();
  }
});

const settings = document.getElementById('settings');
mainButton.addEventListener('click', () => {
  //sessionStorage.removeItem("mod");
  //sessionStorage.removeItem("mins");
  //sessionStorage.removeItem("secs");
});

const modeButtons = document.querySelector('#js-mode-buttons');
modeButtons.addEventListener('click', handleMode);

function getRemainingTime(endTime) {
  const currentTime = Date.parse(new Date());
  const difference = endTime - currentTime;

  const total = Number.parseInt(difference / 1000, 10);
  const minutes = Number.parseInt((total / 60) % 60, 10);
  const seconds = Number.parseInt(total % 60, 10);

  return {
    total,
    minutes,
    seconds,
  };
}

function startTimer() {
  let { total } = timer.remainingTime;
  const endTime = Date.parse(new Date()) + total * 1000;
  sessionStorage.setItem("mod", timer.mode);

  if (timer.mode === 'pomodoro') timer.sessions++;

  mainButton.dataset.action = 'stop';
  mainButton.textContent = 'stop';
  mainButton.classList.add('active');

  interval = setInterval(function() {
    timer.remainingTime = getRemainingTime(endTime);
    updateClock();

    total = timer.remainingTime.total;
    if (total <= 0) {
      clearInterval(interval);

      switch (timer.mode) {
        case 'pomodoro':
          if (timer.sessions % timer.longBreakInterval === 0) {
            switchMode('longBreak');
          } else {
            switchMode('shortBreak');
          }
          break;
        default:
          switchMode('pomodoro');
      }

      if (Notification.permission === 'granted') {
        const text =
          timer.mode === 'pomodoro' ? 'Get back to work!' : 'Take a break!';
        new Notification(text);
      }

      document.querySelector(`[data-sound="${timer.mode}"]`).play();

      startTimer();
    }
  }, 1000);
}

function stopTimer() {
  clearInterval(interval);

  mainButton.dataset.action = 'start';
  mainButton.textContent = 'start';
  mainButton.classList.remove('active');

  localStorage.clear("mod");
  localStorage.clear("mins");
  localStorage.clear("secs");
}

function updateClock() {
  const { remainingTime } = timer;
  const minutes = `${remainingTime.minutes}`.padStart(2, '0');
  const seconds = `${remainingTime.seconds}`.padStart(2, '0');

  localStorage.setItem("mins", minutes);
  localStorage.setItem("secs", seconds);

  const min = document.getElementById('js-minutes');
  const sec = document.getElementById('js-seconds');
  min.textContent = minutes;
  sec.textContent = seconds;

  const text =
    timer.mode === 'pomodoro' ? 'Get back to work!' : 'Take a break!';
  document.title = `${minutes}:${seconds} — ${text}`;

  const progress = document.getElementById('js-progress');
  progress.value = timer[timer.mode] * 60 - timer.remainingTime.total;
}

//thisssss
function switchMode(mode) {
  localStorage.setItem("mod",mode);
  timer.mode = mode;
  timer.remainingTime = {
    total: timer[mode] * 60,
    minutes: timer[mode],
    seconds: 0,
  };

  document
    .querySelectorAll('button[data-mode]')
    .forEach(e => e.classList.remove('active'));
  document.querySelector(`[data-mode="${mode}"]`).classList.add('active');
  document.body.style.backgroundColor = `var(--${mode})`;
  document
    .getElementById('js-progress')
    .setAttribute('max', timer.remainingTime.total);

  updateClock();
}

function handleMode(event) {
  const { mode } = event.target.dataset;

  if (!mode) return;

  switchMode(mode);
  stopTimer();
}

function test(mode)
{
  let mins=localStorage.getItem("mins");
  let secs=localStorage.getItem("secs");

   timer.mode = mode;
   timer.remainingTime = {
    total: (mins*60)+secs,
    minutes: mins,
    seconds: secs,
  };

  document
    .querySelectorAll('button[data-mode]')
    .forEach(e => e.classList.remove('active'));
  document.querySelector(`[data-mode="${mode}"]`).classList.add('active');
  document.body.style.backgroundColor = `var(--${mode})`;
  document
    .getElementById('js-progress')
    .setAttribute('max', timer.remainingTime.total);

  updateClock();
}

document.addEventListener('DOMContentLoaded', () => {
  if ('Notification' in window) {
    if (
      Notification.permission !== 'granted' &&
      Notification.permission !== 'denied'
    ) {
      Notification.requestPermission().then(function(permission) {
        if (permission === 'granted') {
          new Notification(
            'Awesome! You will be notified at the start of each session'
          );
        }
      });
    }
  }
  switchMode('pomodoro');
  /**
  if(localStorage.getItem("mod")==null)
  {
    switchMode('pomodoro');
  }
  else
  {
    let mod=localStorage.getItem("mod");
    test(mod);
    startTimer();
  }
  /**
  if (sessionStorage.getItem("mod") === null) {
     switchMode('pomodoro');
  }
  else
  {
     let mod=sessionStorage.getItem("mod");
     test(mod);
     startTimer();
  } **/
});