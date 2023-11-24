import { useState } from "react";
import { tabsType } from "./contants";
import { MovieTabButton } from "./movie-tab-button";
import { MovieTabCastsSection } from "./movie-tab-casts-section";
import { MovieTabCommentsSection } from "./movie-tab-comments-section";
import { MovieCommentsProvider } from "./movie-comments-context";

export function MovieTabSection({ data }) {
    const [activeTab, setActiveTab] = useState(tabsType.MORE_INFORMATION);
    return (
        <div className="movie-info-page-2-container">
            <div className="tab-btns">
                <MovieTabButton
                    id={tabsType.MORE_INFORMATION}
                    active={activeTab === tabsType.MORE_INFORMATION}
                    onClick={() => setActiveTab(tabsType.MORE_INFORMATION)}
                >
                    More Information
                </MovieTabButton>
                <MovieTabButton
                    id={tabsType.COMMENTS}
                    active={activeTab === tabsType.COMMENTS}
                    onClick={() => setActiveTab(tabsType.COMMENTS)}
                >
                    Comments
                </MovieTabButton>
            </div>
            <hr className="divider" />
            <div>
                <MovieTabCastsSection activeTab={activeTab} data={data} />
                <MovieCommentsProvider data={data}>
                    <MovieTabCommentsSection
                        activeTab={activeTab}
                        data={data}
                    />
                </MovieCommentsProvider>
            </div>
        </div>
    );
}
