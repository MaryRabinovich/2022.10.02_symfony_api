const feedbackList = {

    show() {
        axios.get(API_URL)
            .then(response => this.render(response.data))
    },

    render(data) {
        data.forEach(
            feedback => renderFeedback.render(feedback)
        )
    }
}