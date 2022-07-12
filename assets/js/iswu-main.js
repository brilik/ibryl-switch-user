function PluginSwitchUser() {
    const d = document,
        widget = d.createElement("div"),
        arrowLeft = "\u2770",
        arrowRight = "\u2771",
        arrow = d.createElement("button")

    PluginSwitchUser.prototype.init = () => {
        this.widget.pasteElement()
        this.widget.createArrow()
        this.getUsersAjax()
        this.scrollAnimate()
    }

    PluginSwitchUser.prototype.getUsersAjax = () => {
        let data = {
            action: "switch_user_get_users",
            slug: iswu.pluginSlug,
        }

        fetch(iswu.ajaxUrl, {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(data).toString(),
        }).then(
            response => response.json()
        ).then(
            response => {
                PluginSwitchUser.prototype.renderUsersList(response.data)
                widget.classList.remove("hidden")
            }
        )
    }

    PluginSwitchUser.prototype.widget = {
        pasteElement: () => {
            widget.id = iswu.pluginSlug
            widget.classList.add("close")
            widget.classList.add("hidden")
            d.body.insertAdjacentElement("afterbegin", widget)
        },
        createArrow: () => {
            arrow.type = "button"
            arrow.textContent = arrowLeft
            arrow.classList.add("arrow")
            arrow.classList.add("left")
            widget.appendChild(arrow)
            arrow.addEventListener("click", function () {
                if (this.classList.contains("left")) {
                    PluginSwitchUser.prototype.widget.open()
                } else if (this.classList.contains("right")) {
                    PluginSwitchUser.prototype.widget.close()
                }
            })
        },
        open: () => {
            arrow.classList.remove("left")
            arrow.classList.add("right")
            arrow.textContent = arrowRight

            if (widget.classList.contains("close")) {
                widget.classList.remove("close")
                widget.classList.add("open")
            }
        },
        close: () => {
            arrow.classList.remove("right")
            arrow.classList.add("left")
            arrow.textContent = arrowLeft

            if (widget.classList.contains("open")) {
                widget.classList.remove("open")
                widget.classList.add("close")
            }
        },
    }

    PluginSwitchUser.prototype.setUserByIdAjax = (id) => {
        let data = {
            action: "switch_user_set_user",
            id: id,
        }

        fetch(iswu.ajaxUrl, {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(data).toString(),
        }).then(
            response => response.json(),
        ).then(
            response => {
                if (true === response.success) {
                    window.location.reload()
                }
            }
        )
    }

    PluginSwitchUser.prototype.renderUsersList = (users) => {
        let list = d.createElement("ul")
        list.classList.add("list")

        for (let key in users) {
            var item = d.createElement("li")
            item.classList.add("item")

            var btn = d.createElement("button")
            btn.onclick = () => {
                PluginSwitchUser.prototype.setUserByIdAjax(users[key].id);
            }
            btn.type = "button"
            btn.title = users[key].role
            btn.innerText = users[key].name

            item.appendChild(btn)
            list.appendChild(item)
        }

        d.getElementById(iswu.pluginSlug).appendChild(list)
    }

    PluginSwitchUser.prototype.scrollAnimate = () => {
        // Adds scroll and key up listener in window
        ["scroll", "keyup"].forEach((eventName) => {
            window.addEventListener(eventName, (event) => {
                if (event.target !== widget && widget.classList.contains("open")) {
                    setTimeout(() => {
                        PluginSwitchUser.prototype.widget.close()
                    }, 500);
                }
            })
        })
    }
}

const object = new PluginSwitchUser()
object.init()
