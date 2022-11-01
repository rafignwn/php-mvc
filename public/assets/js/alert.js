function createAlert({
  text = "My Alert is ready to use!",
  type = "blank",
  delay = { show: 1500, end: 6000 },
} = {}) {
  // get alert container
  let container = document.querySelector(".alert-container");

  //   cek alert container
  if (!container) {
    // if not exsist create new alert container element
    container = document.createElement("div");
    // give class alert-container
    container.classList.add("alert-container");
    // and render alert container to body
    document.querySelector("body").appendChild(container);
  }

  // create element
  // create alert element
  let alert = document.createElement("div");
  // create button element
  const btnClose = document.createElement("button");
  // create button element
  const textAlert = document.createElement("span");

  switch (type) {
    case "info": {
      alert = changeAlertType({
        alert,
        iconName: "information-sharp",
      });
      break;
    }
    case "warning": {
      alert = changeAlertType({ alert, iconName: "warning-sharp" });
      break;
    }
    case "danger": {
      alert = changeAlertType({ alert, iconName: "alert-circle-sharp" });
      break;
    }
    case "success": {
      alert = changeAlertType({ alert, iconName: "checkmark-circle" });
      break;
    }
    case "primary": {
      alert = changeAlertType({ alert, iconName: "information-circle-sharp" });
      break;
    }
    case "shake": {
      alert = changeAlertType({ alert, iconName: "hand-right-sharp" });
      break;
    }
    default: {
      alert = changeAlertType({ alert });
    }
  }

  // add attribute element
  textAlert.textContent = text;
  // give class name to alert element
  alert.classList.add("alert", type);

  // render text and button into alert element
  alert.appendChild(textAlert);
  alert.appendChild(btnClose);
  // render alert element into alert container
  container.appendChild(alert);

  // get current alert
  let currentAlert = document.querySelectorAll(".alert");
  currentAlert = currentAlert[currentAlert.length - 1];
  // add class show into alert element
  // timeout for show element
  const timeoutShow = setTimeout(function () {
    currentAlert.classList.add("show");
    // clear timeout
    clearTimeout(timeoutShow);
  }, delay.show);
  // timeout for end element
  const timeoutEnd = setTimeout(async function () {
    console.log("end in timeout");
    // destroy alert
    destroyAlert(alert, timeoutEnd);
  }, delay.end);

  // event for button
  btnClose.addEventListener("click", async function () {
    // get alert
    const alert = btnClose.closest(".alert");

    // remove alert
    destroyAlert(alert, timeoutEnd);
  });

  return {
    timeoutEnd,
    alert,
  };
}

async function destroyAlert(
  alert = document.querySelector(".alert"),
  timeoutEnd = setTimeout(destroyAlert, 0)
) {
  const container = document.querySelector(".alert-container");
  // and remove class show from alert element
  alert.classList.remove("show");
  alert.classList.add("hide");
  // give delay for animate
  await new Promise((resolve) => setTimeout(resolve, 2000));
  // remove alert element from container

  alert && container.removeChild(alert);
  clearTimeout(timeoutEnd);
}

function changeAlertType({
  alert = document.createElement("div"),
  iconName = "heart",
}) {
  // create parent of icon
  const parent = document.createElement("span");
  parent.classList.add("icon");
  // create icon element
  const icon = document.createElement("ion-icon");
  icon.name = iconName;

  // render icon into alert element
  parent.appendChild(icon);
  alert.appendChild(parent);

  // return alert
  return alert;
}
