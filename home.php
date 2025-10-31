<?php
session_start();

// Se não estiver logado, redireciona
if (!isset($_SESSION['nome'])) {
    echo "
    <script>
        alert('Você precisa fazer login primeiro!');
        window.location.href = 'login.html';
    </script>
";
exit;
}
$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nutricionista Virtual</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="icon" type="image/png" href="image/logoTCC.png"/>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box; /* Adicionado para garantir que padding e border sejam incluídos na largura/altura */
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth; /* Adiciona rolagem suave para âncoras */
    }

    body {
      background: url('https://img.freepik.com/free-photo/buddha-bowl-dish-with-vegetables-legumes-top-view_1150-42589.jpg?w=2000') no-repeat center center/cover;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-attachment: fixed;
      min-height: 100vh;
      animation: fadeIn 0.5s ease-in-out;
  
      overflow-x: hidden;
    }

    body.fade-out {
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }


    header {
      background: rgba(0, 0, 0, 0.7);
      padding: 15px 50px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      width: 100%;
      z-index: 10;
    }

    .logo {
      font-size: 22px;
      font-weight: bold;
      color: #ffffff;
    }

    nav ul {
      list-style: none;
      display: flex;
      flex-wrap: wrap; /* Permite que os itens da navegação quebrem a linha em telas menores */
      gap: 25px;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: 200;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #858585;
    }
 
   
    .hero {
      flex: 6;
      display: flex;
      height: 100%; /* Garante que o hero ocupe toda a altura */
      width : 100%;
      flex-direction: column;
      justify-content: center;
      align-items: center; /* Mantido para centralizar o conteúdo verticalmente */
      text-align: center;
      padding: 20px;
      position: relative;
      z-index: 1;
      
    }

  

    .hero h1 {
      font-size: 42px;
      margin: 100px 0 10px 0;
      color: #ffffffff;
      text-shadow: 10px 10px 10px rgba(0, 0, 0, 0.9);
    }

    .hero p {
      font-size: 30px;
      color: #ffffffff;
      max-width: 700px;
      margin-bottom: 30px;
      font-weight: 600;
      text-shadow: 10px 10px 10px rgba(0, 0, 0, 0.9);
    }


    footer {
      background: rgba(0, 0, 0, 0.7);
      text-align: center;
      padding: 10px;
      font-size: 14px;
      color:white
    }

    /* Seção de contatos */
    #contatos {
      scroll-margin-top: 90px; /* evita que o header fixe cobre o conteúdo ao navegar por âncoras */
      padding: 40px 20px;
      background: rgba(255, 255, 255, 0.9);
      color: #111;
      border-radius: 10px;
      width: min(1000px, 95%);
      margin: 40px auto;
      box-shadow: 0 6px 18px rgba(0,0,0,0.15);
      text-align: center;
    }

    #contatos h2 {
      margin-bottom: 10px;
      font-size: 28px;
    }

    #contatos p {
      font-size: 18px;
      margin: 6px 0;
    }

    #contatos a {
      color: #0b6b1f;
      font-weight: 600;
      text-decoration: none;
    }

    .botao-link {
      padding: 5px 15px;
      background: #d3d2d2;
      color: rgb(0, 0, 0);
      border-radius: 5px;
      text-decoration: none;
      font-weight: 600; 
      transition: background-color 0.3s;
      border: none;
    }

    #calculadora {
        padding: 30px; /* Ajustado e unificado */
        background: rgba(255, 255, 255, 0.8); /* Unificado */
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        gap: 45px; /* Ajustado e unificado */
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        position: relative;
        bottom: 180px;
        height: 580px;
        width: 400px;
        
    }

    #calculadora h2{
      font-size: 32px;

    }
    
    .hero-content {
        display: flex;
        align-items: center;
        gap: 250px;
        margin-top: 10px;
    }
    #calculadora input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        text-align: center;
        font-size: 20px;
    }

    #calculadora label {
        font-size: 30px;
        font-weight: 600;
    }

    #calculadora .btn-calcular {
        padding: 12px;
        border-radius: 8px;
        background-color: #3a9120; /* Verde do tema */
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    #calculadora .btn-calcular:hover {
        background-color: #074701; /* Verde mais escuro */
    }

    /* Estilos do Modal */
    .modal {
        display: none; /* Escondido por padrão */
        position: fixed;
        z-index: 20;
        left: 0;
        top: 10;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.6);
        animation: fadeIn 0.3s;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .slide{
      margin-top: 10px;
      margin-bottom: 80px;
      width: 800px;
      height: 800px;
      max-width: 700px; /* Limita a largura máxima do carrossel */
      overflow: hidden;

    }

    .slide h2{
      text-shadow: 2px 2px 10px rgba(255, 255, 255, 0.7);
      margin: 20px;
    }

    .carrosel1{
      width: 300%; /* Ajustado para 3 slides (3 * 100%) */
      height: auto;
      display: flex;
    }

    .carrosel input{
      display: none;
    }

    .slide-box{
      /* Cada slide ocupa 1/3 do container .carrosel1 */
      width: 33.3333%; 
      height: auto;
      position: relative;
      transition: 2s;

    }

    .slide-box img{
      width: 100%;
      height: auto;
      border: 3px solid #ffffff; /* Adiciona uma borda branca de 3px */
      border-radius: 15px; /* Adiciona bordas arredondadas */
    }

    .nav-manual, .nav-auto{
      position: absolute;
      width: 100%;
      margin-top: 35%;
      display: flex;
      justify-content: center;

    }

    .nav-manual .manual-btn, .nav-auto div {
    
      padding: 10px;
      border-radius: 50%;
      cursor: pointer;
      transition: 0.5s;
    }

    .nav-manual .manual-btn:not(:last-child), .nav-auto div:not(:last-child){
      margin-right: 10px;
    }

   
   
    #carrosel1:checked ~ .primeiro{
      margin-left: -1.8%;
    }

    #carrosel2:checked ~ .primeiro{
      margin-left: -35.2%;
    }

    #carrosel3:checked ~ .primeiro{
      margin-left: -68.6%;
    }

  
    .primeiro {
      width: 100%;
      height: auto;
      display: flex;
      transition: 2s;
    }
    
    #contatos {
      scroll-margin-top: 90px; /* evita que o header fixe cobre o conteúdo ao navegar por âncoras */
      padding: 40px 20px;
      background: rgba(255, 255, 255, 0.9);
      color: #111;
      border-radius: 10px;
      width: min(1000px, 95%);
      margin: 40px auto;
      box-shadow: 0 6px 18px rgba(0,0,0,0.15);
      text-align: center;
    }

    #contatos h2 {
      margin-bottom: 10px;
      font-size: 28px;
    }

    #contatos p {
      font-size: 18px;
      margin: 6px 0;
    }

    #contatos a {
      color: #0b6b1f;
      font-weight: 600;
      text-decoration: none;
    }

    #contatos .contato-form {
      margin-top: 25px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    #contatos .contato-form label {
      font-size: 18px;
      font-weight: 600;
      text-align: left;
    }

    #contatos .contato-form textarea {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
      resize: vertical;
      min-height: 120px;
    }

    #contatos .contato-form input {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
    }


    #contatos .btn-enviar {
      align-self: center;
      width: 50%;
    }

  </style>
</head>
<body>

  <header>
    <div class="logo"> NutriTech</div>
    <nav>
      <ul>
        <li><a href="telaInicial.html">Início</a></li>
        <li><a href="planos.html">Planos</a></li>
        <li><a href="#contatos">Contatos</a></li>
        <li><a href="adicionaAlimentos.html" class="botao-link" >Adicionar Refeições</a></li>
        <li><a href="logout.php" class="botao-link">Sair</a></li>
      </ul>
    </nav>
  </header>

  <main class="hero">
    <h1>  Seja bem-vindo <?php echo htmlspecialchars($nome); ?>!</h1>
    <p>Chegou a hora de acompanhar sua dieta de forma prática e personalizada.</p>
    
    <div class="hero-content">
        <div id="calculadora">
            <h2>Calculadora de IMC</h2>
            <label for="peso">Peso (kg):</label>
            <input type="number" id="peso" placeholder="Ex: 70">
            <label for="altura">Altura (m):</label>
            <input type="number" step="0.01" id="altura" placeholder="Ex: 1.75">
            <button class="btn-calcular" onclick="calcularIMC()">Calcular IMC</button>
        </div>

        <section class="slide">
            <h2>Aqui vão alguma dicas para o seu dia a dia!</h2>
            <div class="carrosel1">
                <input type="radio" name="carrosel" id="carrosel1" checked>
                <input type="radio" name="carrosel" id="carrosel2">
                <input type="radio" name="carrosel" id="carrosel3">

                <div class="primeiro">
                    <div class="slide-box"><img src="image/carrosel1.png" alt="carrosel"></div>
                    <div class="slide-box"><img src="image/carrosel2.png" alt="carrosel"></div>
                    <div class="slide-box"><img src="image/carrosel3.png" alt="carrosel"></div>
                </div>

                <div class="nav-auto">
                    <div class="auto-btn1"></div><div class="auto-btn2"></div><div class="auto-btn3"></div><div class="auto-btn4"></div>
                </div>
                <div class="nav-manual">
                    <label for="carrosel1" class="manual-btn"></label>
                    <label for="carrosel2" class="manual-btn"></label>
                    <label for="carrosel3" class="manual-btn"></label>
                </div>
            </div>
        </section>
    </div>
  </main>

  <!-- O Modal -->
  <div id="modalIMC" class="modal">
    <div class="modal-content">
      <span class="close-button" onclick="fecharModal()">&times;</span>
      <h2>Resultado do seu IMC</h2>
      <p id="resultadoTexto"></p>
    </div>
  </div>

  <!-- Seção de Contatos -->
  <!-- Seção de Contatos -->
  <section id="contatos" aria-label="Contatos">
    <h2>Contatos</h2>
    <p>Telefones: <a href="tel:+5511999999999">+55 (11) 99999-9999</a></p>
    <p>E-mail: <a href="mailto:contato@nutritech.com">contato@nutritech.com</a></p>
    <p>Se preferir, deixe sua mensagem abaixo que entraremos em contato.</p>

    <form id="formContato" action="enviar_contato.php" method="POST" class="contato-form">
      <label for="contato-nome">Seu Nome:</label>
      <input type="text" id="contato-nome" name="nome" placeholder="Digite seu nome completo" required>
      <label for="contato-telefone">Seu Telefone:</label>
      <input type="tel" id="contato-telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" required>
      <label for="mensagem">Descreva seu problema ou dúvida:</label>
      <textarea id="mensagem" name="mensagem" placeholder="Digite sua mensagem aqui..." required></textarea>
      <button type="submit" class="btn-calcular btn-enviar">Enviar Mensagem</button>
    </form>
  </section>

  <script>
    // Adiciona o efeito de fade-out ao clicar em links internos
    document.addEventListener("DOMContentLoaded", function() {
      const links = document.querySelectorAll('a');

      links.forEach(link => {
        // Ignora links que abrem em nova aba ou que são apenas âncoras
        if (link.target === '_blank' || link.getAttribute('href').startsWith('#')) {
          return;
        }

        link.addEventListener('click', function(e) {
          const destination = this.href;

          // Previne a navegação imediata
          e.preventDefault();

          // Adiciona a classe para iniciar a animação de saída
          document.body.classList.add('fade-out');

          // Espera a animação terminar para então navegar
          setTimeout(() => {
            window.location.href = destination;
          }, 500); // Este tempo deve ser igual à duração da transição no CSS
        });
      });
    });

    // Funções da Calculadora de IMC e Modal
    const modal = document.getElementById('modalIMC');
    const resultadoTexto = document.getElementById('resultadoTexto');

    function calcularIMC() {
      const peso = parseFloat(document.getElementById('peso').value);
      const altura = parseFloat(document.getElementById('altura').value);

      if (isNaN(peso) || isNaN(altura) || peso <= 0 || altura <= 0) {
        alert('Por favor, insira valores válidos para peso e altura.');
        return;
      }

      const imc = peso / (altura * altura);
      const imcFormatado = imc.toFixed(2);

      let classificacao = '';
      if (imc < 18.5) {
        classificacao = 'Abaixo do peso';
      } else if (imc < 24.9) {
        classificacao = 'Peso normal';
      } else if (imc < 29.9) {
        classificacao = 'Sobrepeso';
      } else if (imc < 34.9) {
        classificacao = 'Obesidade Grau I';
      } else if (imc < 39.9) {
        classificacao = 'Obesidade Grau II';
      } else {
        classificacao = 'Obesidade Grau III';
      }

  resultadoTexto.innerHTML = `Seu IMC é <strong>${imcFormatado}</strong>.<br>Classificação: <strong>${classificacao}</strong>.`;
  modal.style.display = 'block';
    }

    function fecharModal() {
      modal.style.display = 'none';
    }

    // Fecha o modal se o usuário clicar fora da caixa de conteúdo
    window.onclick = function(event) {
      if (event.target == modal) {
        fecharModal();
      }
    }

    // Carrossel automático
    var cont = 1;
    var radio = document.querySelector('.manual-btn')

    // document.getElementById('carrosel1').checked = true; // Removido, pois já foi definido no HTML
    setInterval(() => {
      nextImage();
    }, 5000);

    function nextImage(){
      cont++;
      if(cont > 3){
        cont = 1
      }

      document.getElementById('carrosel'+cont).checked = true;
    }

  </script>




</body>
</html>