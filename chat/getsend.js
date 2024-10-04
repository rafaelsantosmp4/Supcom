var isEditing = false;
document.getElementById('message').addEventListener('keypress', function(e) {
    var key = e.which || e.keyCode;
    if (key === 13) { 
        e.preventDefault(); 
        if (isEditing == true) {
            sendEditedMessage();
        } else {
            sendMessage();
        }
    }
});

const messagesDiv = document.getElementById('messages');
const scrollToBottomButton = document.getElementById('scrollToBottom');
messagesDiv.addEventListener('scroll', function() {
    if (messagesDiv.scrollTop + messagesDiv.clientHeight < messagesDiv.scrollHeight) {
        scrollToBottomButton.style.display = 'block';
    } else {
        scrollToBottomButton.style.display = 'none';
    }
});
scrollToBottomButton.addEventListener('click', function() {
    messagesDiv.scroll({
        top: messagesDiv.scrollHeight,
        behavior: 'smooth'
    });
    scrollToBottomButton.style.display = 'none'; 
});


function sendMessage() {
    var message = document.getElementById('message').value;
    if (message.trim() === '') return; 
    fetch('sendMessage.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'message=' + encodeURIComponent(message) + '&sender_id=' + myId + '&receiver_id=' + chatPartnerId
    }).then(() => {
        document.getElementById('message').value = '';
        return fetchMessages();
    }).then(() => {
        var messagesDiv = document.getElementById('messages');
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });
}

var urlParams = new URLSearchParams(window.location.search);
var myId = urlParams.get('myid'); 
var chatPartnerId = urlParams.get('idforn');
var partnerName = '';

document.getElementById('send').addEventListener('click', function() {
    var message = document.getElementById('message').value;
    if(message != '') {
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
    } else {
        Swal.fire({
        title: 'Sem conteúdo!',
        text: 'Sua mensagem precisa ter algum conteúdo.',
        icon: 'error',
        confirmButtonText: 'OK'
        })
    }
});

let firstLoad = true;
function fetchMessages() {
    return fetch('getMessages.php?myid=' + myId + '&idforn=' + chatPartnerId)
        .then(response => response.json())
        .then(data => {
            partnerName = data.partner_name;
            var messages = data.messages;
            var messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML = '';
            messages.forEach(function(message) {
                var msgElement = document.createElement('div');
                msgElement.className = message.sender_id == myId ? 'message-sent' : 'message-received';
                msgElement.setAttribute('data-message-id', message.id);

                var sender = message.sender_id == chatPartnerId ? partnerName : 'Eu';
                var timestamp = new Date(message.created_at);
                var options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
                var formattedTime = timestamp.toLocaleDateString('pt-BR', options);

                if (message.deleted == 1) {
                    msgElement.innerHTML = `
                        <div class="message-body" style="pointer-events: none;">
                            <p><span id="deletedMessageSpan"> Mensagem apagada!</span></p>
                            <span class="message-timestamp">${formattedTime}</span>
                        </div>
                    `;
                } else {
                    if (message.edited == 1) {
                        msgElement.innerHTML = `
                            <div class="message-body">
                                <p>${message.messagetext}</p>
                                <span class="message-timestamp">${formattedTime}</span>
                                <span class='message-edited'>Editada</span>
                            </div>
                        `;
                    } else {
                        msgElement.innerHTML = `
                            <div class="message-body">
                                <p>${message.messagetext}</p>
                                <span class="message-timestamp">${formattedTime}</span>
                            </div>
                        `;
                    }   
                }

                messagesDiv.appendChild(msgElement);
            });

            document.getElementById('titulochat').innerHTML = partnerName;
            if (firstLoad) {
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
                firstLoad = false; 
            }
        });
}
window.onload = function() {
    fetchMessages();
    document.getElementById('message').focus();
};
setInterval(fetchMessages, 3000);

document.addEventListener('keydown', function(event) {
    if ((event.key.length === 1 && event.key.match(/[a-zA-Z]/)) && !event.ctrlKey && !event.altKey && !event.shiftKey && !event.metaKey) {
        document.getElementById('message').focus();
    }
});