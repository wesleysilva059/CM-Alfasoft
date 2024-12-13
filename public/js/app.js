document.addEventListener('DOMContentLoaded', function() {
    // Carregar lista de contatos
    if (document.getElementById('contacts-table')) {
        fetchContacts();
    }

    // Função para buscar contatos na API e atualizar a tabela
    function fetchContacts() {
        fetch('/api/contacts')  // Supondo que sua API esteja disponível em /api/contacts
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#contacts-table tbody');
                tableBody.innerHTML = '';  // Limpar a tabela antes de adicionar os dados

                data.forEach(contact => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${contact.id}</td>
                        <td>${contact.name}</td>
                        <td>${contact.contact}</td>
                        <td>${contact.email}</td>
                        <td>
                            <a href="/contacts/${contact.id}">Ver</a>
                            <a href="/contacts/${contact.id}/edit">Editar</a>
                            <button class="delete-btn" data-id="${contact.id}">Excluir</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });

                // Adicionar evento de exclusão
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const contactId = this.getAttribute('data-id');
                        deleteContact(contactId);
                    });
                });
            });
    }

    // Função para excluir um contato
    function deleteContact(contactId) {
        fetch(`/api/contacts/${contactId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
        .then(response => {
            if (response.ok) {
                fetchContacts(); // Recarregar os contatos após exclusão
            } else {
                alert('Erro ao excluir o contato.');
            }
        });
    }
});
