import React from "react";
import ReactDOM from "react-dom/client";
import App from "./notify/App";

import { BrowserRouter, Routes, Route } from "react-router-dom";

const root = ReactDOM.createRoot(document.getElementById("notify"));
function Dashboard() {
    return (
        <div>
            <h1>Dashboard</h1>
            <nav> ssasas</nav>
            <hr />
        </div>
    );
}

root.render(
    <React.StrictMode>
        {/* <BrowserRouter> */}
        <App />
        {/* </BrowserRouter> */}
    </React.StrictMode>
);
