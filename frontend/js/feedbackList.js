const feedbackList = {

    pagesView: document.getElementById('pages'),
    listView: document.getElementById('feedback-list'),

    show(page) {
        axios.get(API_URL + '?page=' + page)
            .then(response => this.render(response.data))
    },

    render(data) {
        this.pagesView.innerHTML = ''
        this.renderPagination(data)

        this.listView.innerHTML = ''
        data.content.forEach(
            feedback => renderFeedback.render(feedback)
        )
    },

    renderPagination(data) {
        const pageNum = Math.ceil(data.total / data.per_page)
        let active
        for (i = 1; i <= pageNum; i++) {
            active = i === data.current_page
            this.pagesView.innerHTML += this.getLink(i, active)
        }
    },

    getLink(i, active = false) {
        let activeClass = ''
        if (active) {
            activeClass = 'feedback-list__menu__item-active'
        }
        return `
            <button onclick="feedbackList.show(${i})"
                class="feedback-list__menu__item ${activeClass}">
                ${i}
            </button>
        `
    }
}