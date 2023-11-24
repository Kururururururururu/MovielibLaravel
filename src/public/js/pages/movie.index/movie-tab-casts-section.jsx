import { tabsType } from "./contants";
import { MovieTab } from "./movie-tab";

export function MovieTabCastsSection({ data, activeTab }) {
    return (
        <MovieTab
            id={tabsType.MORE_INFORMATION}
            active={activeTab === tabsType.MORE_INFORMATION}
            title={"Casts"}
        >
            <div className="movie-casts">
                {Object.values(data.credits.cast).map((person) => (
                    <div className="movie-person" key={person.id}>
                        {person.profile_path ? (
                            <img
                                src={`https://image.tmdb.org/t/p/original${person.profile_path}`}
                                alt={person.name}
                                className="movie-person-img"
                            />
                        ) : (
                            <img
                                src={
                                    new URL(
                                        "../../../images/person-placeholder.jpg",
                                        import.meta.url
                                    )
                                }
                                alt={person.name}
                                className="movie-person-img"
                            />
                        )}
                        <p className="movie-person-name">{person.name}</p>
                        <p className="movie-person-character">
                            {person.character}
                        </p>
                    </div>
                ))}
            </div>
        </MovieTab>
    );
}
