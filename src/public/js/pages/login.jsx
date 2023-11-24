import React from "react";
import ReactDOM from "react-dom/client";

export default function Login() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const handleSubmit = async (event) => {
        event.preventDefault();
        const data = new FormData(event.target);
        const value = Object.fromEntries(data.entries());

        try {
            const response = await fetch(loginRoute, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify(value),
            });

            if (response.ok) {
                window.location.href = "/movies";
            } else {
                throw new Error("Something went wrong");
            }
        } catch (error) {
            console.error("Error:", error);
        }
    };

    return (
        <main>
            <form className="loginform" onSubmit={handleSubmit}>
                <h1>Login</h1>
                <pre></pre>
                <label htmlFor="username">Username:</label>
                <input type="text" id="username" name="username" required />
                <br />
                <label htmlFor="password">Password:</label>
                <input type="password" id="password" name="password" required />
                <br />
                <input type="submit" id="loginbutton" value="Login" />
                <input
                    type="button"
                    id="registerbutton"
                    value="Register"
                    onClick={() => (window.location.href = "/register")}
                />
            </form>
        </main>
    );
}

if (document.getElementById("login")) {
    const data = JSON.parse(
        document.getElementById("login").getAttribute("data")
    );
    ReactDOM.createRoot(document.getElementById("login")).render(
        <Login data={data} />
    );
}
