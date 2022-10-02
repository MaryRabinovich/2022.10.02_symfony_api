const renderFeedback = {

    view: document.getElementById('feedback-list'),

    render(feedback) {
        const element = document.createElement('li')
        element.className = 'feedback-list__element'
        element.innerHTML = this.format(feedback)
        this.view.appendChild(element)
    },

    format(feedback) {
        return `
            <strong>Имя:</strong> ${feedback.name}<br>
            <strong>Телефон:</strong> ${feedback.phone}<br>
            <strong>Создан:</strong> ${feedback.created_at}<br>
        `
    }
}