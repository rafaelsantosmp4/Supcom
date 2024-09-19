<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Simples</title>
</head>
<body>
    <h1 id="titulochat">Carregando...</h1>
    <div id="chat">
        <div id="messages"></div>
        <input id="message" type="text" placeholder="Digite sua mensagem" />
        <button id="send">Enviar</button>
    </div>
    
    <script>
        var myId = null;
        var chatPartnerId = null;

        function updateChatParams() {
            var urlParams = new URLSearchParams(window.location.search);
            var newMyId = urlParams.get('myid');
            var newChatPartnerId = urlParams.get('idforn');

            if (newMyId && newChatPartnerId && (myId !== newMyId || chatPartnerId !== newChatPartnerId)) {
                myId = newMyId;
                chatPartnerId = newChatPartnerId;
                localStorage.setItem('myId', myId);
                localStorage.setItem('chatPartnerId', chatPartnerId);
                fetchMessages();
            }
        }

        function fetchMessages() {
            if (myId && chatPartnerId) {
                fetch('getMessages.php?myid=' + myId + '&idforn=' + chatPartnerId)
                    .then(response => response.json())
                    .then(data => {
                        var partnerName = data.partner_name;
                        var messages = data.messages;
                        var messagesDiv = document.getElementById('messages');
                        messagesDiv.innerHTML = ''; 
                        
                        messages.forEach(function(message) {
                            var msgElement = document.createElement('p');
                            var sender = message.sender_id == chatPartnerId ? partnerName : 'Eu';
                            msgElement.textContent = `${sender}: ${message.message}`;
                            messagesDiv.appendChild(msgElement);
                        });
                        
                        document.getElementById('titulochat').innerHTML = partnerName;
                    })
                    .catch(error => {
                        console.error('Erro ao buscar mensagens:', error);
                    });
            }
        }

        document.getElementById('send').addEventListener('click', function() {
            var message = document.getElementById('message').value;

            fetch('sendMessage.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'message=' + encodeURIComponent(message) + '&sender_id=' + myId + '&receiver_id=' + chatPartnerId
            }).then(() => {
                document.getElementById('message').value = ''; 
                fetchMessages(); 
            });
        });

        setInterval(function() {
            updateChatParams();
            fetchMessages();
        }, 2000);

        updateChatParams(); // Inicializa os parâmetros do chat
    </script>
</body>
</html>
