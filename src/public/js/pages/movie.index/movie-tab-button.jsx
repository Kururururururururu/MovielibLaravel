import { tabsType } from "./contants";

export function MovieTabButton({ children, id, active, onClick }) {
    return (
        <button
            className={`tab-btn ${active ? "active" : ""}`}
            id={id}
            onClick={onClick}
        >
            <input
                type="radio"
                id={`${id}Radio`}
                name="contact"
                value={id}
                defaultChecked={id === tabsType.MORE_INFORMATION}
            />
            <label htmlFor={`${id}Radio`}>{children}</label>
        </button>
    );
}
