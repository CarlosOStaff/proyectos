var words = ["Opciones de administrador"],
  part,
  i = 0,
  offset = 0,
  len = words.length,
  speed = 70,
  interval;

var wordflick = function () {
  interval = setInterval(function () {
    // Incrementa el offset para mostrar la palabra progresivamente
    if (offset < words[i].length) {
      part = words[i].substr(0, offset + 1); // +1 para incluir la última letra
      offset++;
      $(".word").text(part);
    } else {
      // Detén la animación cuando toda la palabra se haya mostrado
      clearInterval(interval);
    }
  }, speed);
};

$(document).ready(function () {
  wordflick();
});
