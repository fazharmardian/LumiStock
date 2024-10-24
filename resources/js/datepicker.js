function datePicker() {
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 5); // Set the max date to 5 days from now

    return {
        returnDate: '',
        minDate: today.toISOString().split('T')[0],
        maxDate: maxDate.toISOString().split('T')[0],
        errorMessage: '',

        isValidDate(date) {
            if (!date) return true;
            const selectedDate = new Date(date);
            const day = selectedDate.getDay(); // 0 = Sunday, 6 = Saturday

            if (day === 0 || day === 6) {
                this.errorMessage = 'Weekends are not allowed.';
                return false;
            }
            this.errorMessage = ''; // Clear error if valid
            return true;
        }
    };
}
