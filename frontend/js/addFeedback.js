const addFeedback = {

    nameView: document.getElementById('name'),
    phoneView: document.getElementById('phone'),
    errorsView: document.getElementById('errors'),
    header: {
        headers: {'Content-Type': 'multipart/form-data'}
    },

    store() {
        const data = {
            name: this.nameView.value,
            phone: this.phoneView.value,
        }
        axios.post(API_URL, data, this.header)
            .then(response => this.render(response.data))
    },

    render(data) {
        if (data.errors) {
            this.errorsView.innerHTML = data.errors.join('<br><br>')
            return
        }
        this.errorsView.innerHTML = ''
        this.nameView.value = ''
        this.nameView.focus()
        this.phoneView.value = ''
        renderFeedback.render(data, true)
    }
}