let selectedMessageId = null;
document.getElementById('messages').addEventListener('contextmenu', function(e) {
    e.preventDefault();
    const messageElement = e.target.closest('.message-sent') || e.target.closest('.message-received');

    if (messageElement) {
        const isDeleted = messageElement.querySelector('#deletedMessageSpan') !== null;

        if (!isDeleted) {
            const isSentByUser = messageElement.classList.contains('message-sent'); 
            if (isSentByUser) {
                selectedMessageId = messageElement.dataset.messageId;
                const contextMenu = document.getElementById('context-menu');
                contextMenu.style.display = 'block';
                contextMenu.style.left = `${e.pageX}px`;
                contextMenu.style.top = `${e.pageY}px`;
            }
        }
    }
});

window.addEventListener('click', function() {
    const contextMenu = document.getElementById('context-menu');
    contextMenu.style.display = 'none';
});

let originalMessage = '';

document.getElementById('edit-message').addEventListener('click', async function() {
    if (selectedMessageId) {
        const response = await fetch(`getMessages.php?myid=${myId}&idforn=${chatPartnerId}&message_id=${selectedMessageId}`);
        const messageData = await response.json();
        
        if (messageData.message) {
            originalMessage = messageData.message.messagetext; 
            document.getElementById('message').value = originalMessage;
            document.getElementById('send').style.display = 'none';
            document.getElementById('edit').style.display = 'block';
            isEditing = true;
            document.getElementById('message').focus();
        } else {
            alert('Mensagem não encontrada.');
        }
    }
});

document.getElementById('edit').addEventListener('click', function() {
    sendEditedMessage();
});

function sendEditedMessage() {
    var editedMessage = document.getElementById('message').value;
    if (editedMessage.trim() === originalMessage.trim()) {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: "Nenhuma edição foi feita.",
        });
    }
    fetch(`editMessage.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'message=' + encodeURIComponent(editedMessage) + '&message_id=' + selectedMessageId
    }).then(() => {                        
        document.getElementById('send').style.display = 'block';
        document.getElementById('edit').style.display = 'none';
        document.getElementById('message').value = '';
        isEditing = false;
        fetchMessages();
    });
}

document.getElementById('delete-message').addEventListener('click', function() {
    if (selectedMessageId) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá desfazer essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, apagar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('deleteMessage.php?message_id=' + encodeURIComponent(selectedMessageId), {
                    method: 'GET',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: data.message
                        }).then(() => {
                            fetchMessages();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: data.message,
                        });
                    }
                });
            }
        });
    }
});