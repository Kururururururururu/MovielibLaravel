export function MovieTab({ children, id, active, title }) {
    return (
        <div
            id={id}
            className="movie-info-extra"
            style={{ display: active ? "block" : "none" }}
        >
            <h1 className="movie-info-extra-title">{title}</h1>
            {children}
        </div>
    );
}
