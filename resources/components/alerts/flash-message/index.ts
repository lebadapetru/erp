import Alert from "resources/components/alerts/flash-message/Alert";

class FlashMessage extends Alert {
  public constructor() {
    super();
  }

  public success({title, description}) {
    this.createBox(['alert-success'])
    this.createIcon(`
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      <rect x="0" y="0" width="24" height="24"></rect>
      <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
      <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"></path>
      </g>
      </svg>
    `, ['svg-icon-success'])
    this.createCloseButton()
    this.createContent()
    this.createTitle(title)
    this.createDescription(description)

    this.content.appendChild(this.title)
    this.content.appendChild(this.description)
    this.box.appendChild(this.icon)
    this.box.appendChild(this.content)
    this.box.appendChild(this.closeButton)
    document.body.appendChild(this.box)
  }

  public danger({title, description}) {
    this.createBox(['alert-danger'])
    this.createIcon(`
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
        <path d="M10.5857864,12 L9.17157288,10.5857864 C8.78104858,10.1952621 8.78104858,9.56209717 9.17157288,9.17157288 C9.56209717,8.78104858 10.1952621,8.78104858 10.5857864,9.17157288 L12,10.5857864 L13.4142136,9.17157288 C13.8047379,8.78104858 14.4379028,8.78104858 14.8284271,9.17157288 C15.2189514,9.56209717 15.2189514,10.1952621 14.8284271,10.5857864 L13.4142136,12 L14.8284271,13.4142136 C15.2189514,13.8047379 15.2189514,14.4379028 14.8284271,14.8284271 C14.4379028,15.2189514 13.8047379,15.2189514 13.4142136,14.8284271 L12,13.4142136 L10.5857864,14.8284271 C10.1952621,15.2189514 9.56209717,15.2189514 9.17157288,14.8284271 C8.78104858,14.4379028 8.78104858,13.8047379 9.17157288,13.4142136 L10.5857864,12 Z" fill="#000000"/>
      </g>
      </svg>
    `, ['svg-icon-danger'])
    this.createCloseButton()
    this.createContent()
    this.createTitle(title)
    this.createDescription(description)

    this.content.appendChild(this.title)
    this.content.appendChild(this.description)
    this.box.appendChild(this.icon)
    this.box.appendChild(this.content)
    this.box.appendChild(this.closeButton)
    document.body.appendChild(this.box)
  }

  public info({title, description}) {
    this.createBox(['alert-primary'])
    this.createIcon(`
      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
      <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
      <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
      </svg>
    `, ['svg-icon-primary'])
    this.createCloseButton()
    this.createContent()
    this.createTitle(title)
    this.createDescription(description)

    this.content.appendChild(this.title)
    this.content.appendChild(this.description)
    this.box.appendChild(this.icon)
    this.box.appendChild(this.content)
    this.box.appendChild(this.closeButton)
    document.body.appendChild(this.box)
  }

  public warning({title, description}) {
    this.createBox(['alert-warning'])
    this.createIcon(`
      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
      <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
      <rect fill="#000000" x="11" y="7" width="2" height="8" rx="1"/>
      <rect fill="#000000" x="11" y="16" width="2" height="2" rx="1"/>
      </svg>
    `, ['svg-icon-warning'])
    this.createCloseButton()
    this.createContent()
    this.createTitle(title)
    this.createDescription(description)

    this.content.appendChild(this.title)
    this.content.appendChild(this.description)
    this.box.appendChild(this.icon)
    this.box.appendChild(this.content)
    this.box.appendChild(this.closeButton)
    document.body.appendChild(this.box)
  }
}

const flashMessage = new FlashMessage();

globalThis.flashMessage = flashMessage