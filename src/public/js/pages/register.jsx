import React from "react";
import ReactDOM from "react-dom/client";
import {
    isValidEmail,
    isValidName,
    isValidPassword,
    isValidUsername,
} from "../register";

export default function Register() {
    const [errors, setErrors] = React.useState({});
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const handleSubmit = async (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        const value = Object.fromEntries(data.entries());

        if (!isValidName(value.name)) {
            console.error("Invalid name");
            return;
        }

        if (!isValidUsername(value.username)) {
            console.error("Invalid username");
            return;
        }

        if (!isValidEmail(value.email)) {
            console.error("Invalid email");
            return;
        }

        if (!isValidPassword(value.password, value.password_confirmation)) {
            console.error("Invalid password");
            return;
        }

        try {
            const response = await axios.post(registerRoute, value, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
            });

            console.log("response");
            console.log(response.data);

            if (response.status === 200) {
                window.location.href = "/movies";
            } else {
                throw new Error("Something went wrong");
            }
        } catch (error) {
            setErrors(error.response.data.errors);
            console.error("Error:", error);
        }
    };

    return (
        <main>
            <form onSubmit={handleSubmit}>
                <section>
                    <h1>Movie Rater</h1>
                    <label htmlFor="name">Name:</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="First and last name"
                        required
                    />
                    {errors.name && (
                        <div className="alert alert-danger">
                            {errors.name[0]}
                        </div>
                    )}
                </section>

                <section>
                    <label htmlFor="username">Username:</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Username"
                        required
                    />
                    {errors.username && (
                        <div className="alert alert-danger">
                            {errors.username[0]}
                        </div>
                    )}
                </section>

                <section>
                    <label htmlFor="email">Email:</label>
                    <input type="email" id="email" name="email" required />
                    {errors.email && (
                        <div className="alert alert-danger">
                            {errors.email[0]}
                        </div>
                    )}
                </section>

                <section>
                    <label htmlFor="password">Password:</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    />
                    {errors.password && (
                        <div className="alert alert-danger">
                            {errors.password[0]}
                        </div>
                    )}
                </section>

                <section>
                    <label htmlFor="password_confirmation">
                        Confirm password:
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                    />
                </section>

                <button type="submit" id="registerButton">
                    Create Movie Rater account
                </button>
                <div className="Alreadycreated">
                    <label htmlFor="Accountexist">
                        Already have an account?
                    </label>
                    <a href={loginRoute} className="link" id="signinButton">
                        Sign in
                    </a>
                </div>
            </form>
        </main>
    );
}

if (document.getElementById("register")) {
    ReactDOM.createRoot(document.getElementById("register")).render(
        <Register />
    );
}
