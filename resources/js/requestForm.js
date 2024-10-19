function formValidation() {
    return {
        formData: {
            return_date: "",
            total_request: null,
        },
        isFormValid: false,

        checkFormValidity() {
            // Check if all required fields are filled
            this.isFormValid =
                this.formData.return_date !== "" &&
                this.formData.total_request !== null &&
                this.formData.total_request >= 1;
        },
    };
}
