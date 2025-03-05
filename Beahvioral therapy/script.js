document.addEventListener("DOMContentLoaded", function () {
    let currentQuestion = 0;
    const questions = document.querySelectorAll(".question");
    const nextButtons = document.querySelectorAll(".next-btn");
    const form = document.getElementById("mentalHealthForm");
    const submitBtn = document.getElementById("submitBtn");

    // Create Previous Buttons Dynamically
    questions.forEach((question, index) => {
        if (index > 0) {
            let prevButton = document.createElement("button");
            prevButton.type = "button";
            prevButton.classList.add("prev-btn");
            prevButton.innerText = "Previous";
            question.insertBefore(prevButton, question.firstChild);
        }
    });

    const prevButtons = document.querySelectorAll(".prev-btn");

    function showNextQuestion() {
        if (currentQuestion < questions.length - 1) {
            questions[currentQuestion].classList.remove("active");
            currentQuestion++;
            questions[currentQuestion].classList.add("active");
        }
    }

    function showPrevQuestion() {
        if (currentQuestion > 0) {
            questions[currentQuestion].classList.remove("active");
            currentQuestion--;
            questions[currentQuestion].classList.add("active");
        }
    }

    nextButtons.forEach(button => {
        button.addEventListener("click", showNextQuestion);
    });

    prevButtons.forEach(button => {
        button.addEventListener("click", showPrevQuestion);
    });

    function checkAllAnswered() {
        let allAnswered = true;
        document.querySelectorAll("select").forEach(select => {
            if (select.value === "") {
                allAnswered = false;
            }
        });
        submitBtn.disabled = !allAnswered;
    }

    document.querySelectorAll("select").forEach(select => {
        select.addEventListener("change", checkAllAnswered);
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        alert("✅ Form submitted successfully!");
    });

    questions[0].classList.add("active"); // Show first question initially
});
