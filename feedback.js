const form = document.getElementById('feedbackForm');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const feedbackData = {
        eventId: document.getElementById('feedback_id').value,
        feedback: document.getElementById('message').value
    };

    try {
        const response = await fetch('http://localhost:3000/feedback', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(feedbackData)
        });

        if (response.ok) {
            alert('Thank you for your feedback!');
            form.reset();
        } else {
            alert('Error submitting feedback.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Server error. Try again later.');
    }
});
