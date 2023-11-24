export function MovieInfoItem({ title, children, asChild = false, className }) {
    return (
        <div className={`movie-info-item ${className ?? ""}`}>
            <p className="movie-info-item-title">{title}</p>
            {asChild ? (
                children
            ) : (
                <p className="movie-info-item-value">{children}</p>
            )}
        </div>
    );
}
