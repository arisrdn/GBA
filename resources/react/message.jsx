import React from "react";
import ReactDOM from "react-dom/client";
import App from "./chat/App";
import Router from "./chat/router";
import Router2 from "./chatg/router";
import { BrowserRouter, Routes, Route } from "react-router-dom";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
    <React.StrictMode>
        <BrowserRouter>
            <Router2 />
        </BrowserRouter>
    </React.StrictMode>
);
