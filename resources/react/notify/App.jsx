import React from "react";
import { useEffect, useRef, useState } from "react";
import ReactLoading from "react-loading";
import { API } from "../url";
import { onMessageListener } from "../firebase";
import Moment from "moment";
import "izitoast/dist/css/iziToast.min.css";
import Izitoast from "izitoast";

function App() {
    // let navigate = useNavigate();
    const [error, setError] = useState(null);
    const [isLoaded, setIsLoaded] = useState(false);
    const [items, setItems] = useState([]);
    const [auth, setAuth] = useState(false);
    const [isDisabled, setIsDisabled] = useState(false);
    const [toast, setToast] = useState({ title: "", body: "" });

    useEffect(() => {
        getUnread();
        fetch("https://gba.test/auth")
            .then((res) => res.json())
            .then((result) => {
                setAuth(result.data);
            });
    }, []);

    const getUnread = () => {
        fetch("https://gba.test/notification/unread")
            .then((res) => res.json())
            .then(
                (result) => {
                    // console.log(result);

                    setIsLoaded(true);
                    setItems(result.data);
                },
                (error) => {
                    setIsLoaded(true);
                    setError(error);
                }
            );
    };

    const sendMarkassread = async () => {
        setIsDisabled(true);
        const requestOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            // body: JSON.stringify(state),
        };
        await fetch(API + "/notification/readall", requestOptions)
            .then((response) => response.text())
            .then((data) => {
                console.log(data);
                getUnread();
                // setState({ ...state, message: "" });
                // getContact();
                setIsDisabled(false);
            })
            .catch((error) => console.log(error));
    };

    onMessageListener()
        .then((payload) => {
            getUnread();
            // showMessage(payload.notification);
            Izitoast.show({
                // title: "Hey",
                // message: "What would you like to add?",
                position: "topRight",
                title: payload.notification.title,
                message: payload.notification.body,
                theme: "info",
                icon: "ico-info",
                color: "blue",
            });
            console.log(payload);
        })
        .catch((err) => console.log("failed: ", err));

    const handleSubmit = (event) => {
        event.preventDefault();
        sendMarkassread();
        console.log("submitting", event);
    };

    if (error) {
        return <p>{error.message},</p>;
    }

    return (
        <>
            {!isLoaded ? (
                <a
                    href="#"
                    data-toggle="dropdown"
                    className="nav-link notification-toggle nav-link-lg "
                >
                    <i className="far fa-bell"></i>
                </a>
            ) : (
                <>
                    <li className="dropdown dropdown-list-toggle">
                        <a
                            href="#"
                            data-toggle="dropdown"
                            className={
                                items.length
                                    ? "nav-link notification-toggle nav-link-lg beep"
                                    : "nav-link notification-toggle nav-link-lg "
                            }
                        >
                            <i className="far fa-bell"></i>
                        </a>
                        <div className="dropdown-menu dropdown-list dropdown-menu-right">
                            <div className="dropdown-header">
                                Notifications
                                {items.length ? (
                                    <>
                                        <span className="badge badge-info">
                                            {items.length}
                                        </span>
                                        <div className="float-right">
                                            <div
                                                className=" clearfix"
                                                onSubmit={handleSubmit}
                                            >
                                                <form>
                                                    <input
                                                        type="submit"
                                                        className="btn"
                                                        value={
                                                            "Mark All As Read"
                                                        }
                                                    />
                                                </form>
                                            </div>
                                        </div>
                                    </>
                                ) : (
                                    ""
                                )}
                            </div>
                            <div className="dropdown-list-content dropdown-list-icons">
                                <div>
                                    {/* <button onClick={showMessage("eee")}>
                                        Show
                                    </button> */}
                                </div>
                                {/* isDisabled */}
                                {items.length ? (
                                    items.map((number) => (
                                        <a
                                            href="#"
                                            className="dropdown-item dropdown-item-unread"
                                            key={number.id}
                                        >
                                            <div className="dropdown-item-icon bg-primary text-white">
                                                <i className="fas fa-code"></i>
                                            </div>
                                            <div className="dropdown-item-desc">
                                                {number.data.name}
                                                <div className="time text-primary">
                                                    2 Min Ago
                                                </div>
                                            </div>
                                        </a>
                                    ))
                                ) : (
                                    <p className="text-muted p-2 text-center">
                                        No notifications found!
                                    </p>
                                )}
                            </div>
                        </div>
                    </li>
                </>
            )}
        </>
    );
}

export default App;
