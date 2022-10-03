const renderFeedback = {

    view: document.getElementById('feedback-list'),

    render(feedback, asFirst = false) {
        const element = document.createElement('li')
        element.className = 'feedback-list__element'
        element.innerHTML = this.format(feedback)
        if (asFirst) {
            this.view.prepend(element)
        } else {
            this.view.append(element)
        }

        console.log(feedback)
    },

    format(feedback) {
        return `
            <strong>Имя:</strong> ${feedback.name}<br>
            <strong>Телефон:</strong> ${feedback.phone}<br>
            <strong>Создан:</strong> ${feedback.created_at}<br>
        `
    }
}