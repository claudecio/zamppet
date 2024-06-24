const canvas = document.getElementById('canvasAssinatura');
const context = canvas.getContext('2d');
let isDrawing = false;
let lastX = 0;
let lastY = 0;

const startDrawing = (event) => {
  if ((event.type === 'mousedown' && event.buttons === 1) || event.type === 'touchstart') {
    event.preventDefault();
    isDrawing = true;
    const rect = canvas.getBoundingClientRect();
    if (event.type === 'mousedown' && event.buttons === 1) {
      const x = event.clientX - rect.left;
      const y = event.clientY - rect.top;
      lastX = x;
      lastY = y;
      context.lineWidth = 5;
      context.strokeStyle = '#000';
      context.beginPath();
      context.moveTo(x, y);
    } else if (event.type === 'touchstart') {
      const touch = event.touches[0];
      const x = touch.clientX - rect.left;
      const y = touch.clientY - rect.top;
      lastX = x;
      lastY = y;
      context.lineWidth = 5;
      context.strokeStyle = '#000';
      context.beginPath();
      context.moveTo(x, y);
    }
  }
};

const draw = (event) => {
  if (isDrawing && event.buttons === 1 && (event.type === 'mousemove' || event.type === 'touchmove')) {
    const rect = canvas.getBoundingClientRect();
    let x, y;
    if (event.type === 'mousemove' && event.buttons === 1) {
      x = event.clientX - rect.left;
      y = event.clientY - rect.top;
    } else if (event.type === 'touchmove') {
      const touch = event.touches[0];
      x = touch.clientX - rect.left;
      y = touch.clientY - rect.top;
    }
    if (x !== lastX || y !== lastY) {
      context.lineTo(x, y);
      context.stroke();
      lastX = x;
      lastY = y;
      updateSignature(); // Chama a função apenas quando o desenho é atualizado
    }
  }
};

const stopDrawing = () => {
  if (isDrawing) {
    isDrawing = false;
  }
};

const clearSignature = () => {
  context.clearRect(0, 0, canvas.width, canvas.height);
  updateSignature(); // Atualiza a assinatura ao limpar o desenho
  document.getElementById('assinaturaBase64').value = ""; // Define o valor do campo como vazio
};

const updateSignature = () => {
  const dataURL = canvas.toDataURL();
  document.getElementById('assinaturaBase64').value = dataURL;
};

// Adicionando os event listeners
canvas.addEventListener('mousedown', (event) => {
  if (event.buttons === 1) { // Verifica se o botão esquerdo do mouse está pressionado
    startDrawing(event);
  }
});
canvas.addEventListener('mousemove', (event) => {
  if (event.buttons === 1) { // Verifica se o botão esquerdo do mouse está pressionado
    draw(event);
  }
});
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseleave', stopDrawing);

// Adiciona um event listener para dispositivos touch
canvas.addEventListener('touchstart', (event) => {
  event.preventDefault();
  const touch = event.touches[0];
  isDrawing = true;
  const rect = canvas.getBoundingClientRect();
  lastX = touch.clientX - rect.left;
  lastY = touch.clientY - rect.top;
  context.lineWidth = 5;
  context.strokeStyle = '#000';
  context.beginPath();
  context.moveTo(lastX, lastY);
});
canvas.addEventListener('touchmove', (event) => {
  event.preventDefault();
  if (isDrawing) {
    const touch = event.touches[0];
    const rect = canvas.getBoundingClientRect();
    const x = touch.clientX - rect.left;
    const y = touch.clientY - rect.top;
    if (x !== lastX || y !== lastY) {
      context.lineTo(x, y);
      context.stroke();
      lastX = x;
      lastY = y;
      updateSignature(); // Chama a função apenas quando o desenho é atualizado
    }
  }
});
canvas.addEventListener('touchend', stopDrawing);
