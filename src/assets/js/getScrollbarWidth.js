function getScrollbarWidth() {
  // Create a temporary div container
  let container = document.createElement("div");
  container.style.visibility = "hidden";
  container.style.overflow = "scroll";
  document.body.appendChild(container);

  // Create an inner div and append it to the container
  let inner = document.createElement("div");
  container.appendChild(inner);

  // Calculate the scrollbar width
  let scrollbarWidth = container.offsetWidth - inner.offsetWidth;

  // Remove the container from the body
  document.body.removeChild(container);

  // Set the scrollbar width as a CSS variable
  document.documentElement.style.setProperty(
    "--scrollbar-width",
    `${scrollbarWidth}px`
  );
}

// Call the function to initialize the CSS variable
getScrollbarWidth();
