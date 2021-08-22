import { PropType } from "vue";

interface AlertBuilder {
  createBox(classList): void;
  createIcon(icon, classList): void;
  createCloseButton(): void;
  createContent(): void;
  createTitle(title): void;
  createDescription(description): void;
}

export default class Alert implements AlertBuilder{
  protected box;
  protected icon;
  protected closeButton;
  protected content;
  protected title;
  protected description;

  public createBox(classList: string[] = []) {
    this.box = document.createElement('div');
    let classes = [
      'alert',
      'alert-dismissible',
      'fade',
      'show',
      'd-flex',
      'align-items-center',
      'flash-message',
      ...classList
    ];
    this.box.classList.add(...classes)
  }

  public createIcon(icon: string = '', classList: string[] = []) {
    this.icon = document.createElement('span')
    let iconClasses = [
      'svg-icon',
      'svg-icon-2hx',
      'me-4',
      ...classList,
    ];
    this.icon.classList.add(...iconClasses)
    this.icon.innerHTML = icon;
  }

  public createContent() {
    this.content = document.createElement('div');
    let classes = [
      'd-flex',
      'flex-column',
    ]
    this.content.classList.add(...classes)
  }

  public createTitle(title: string = 'This is an alert') {
    this.title = document.createElement('h4');
    let classes = [
      'mb-1',
      'text-dark',
    ]
    this.title.classList.add(...classes)
    this.title.innerText = title
  }

  public createDescription(description: string = 'The alert component can be used to highlight certain parts of your page for higher content visibility.') {
    this.description = document.createElement('span');
    this.description.innerText = description
  }

  public createCloseButton() {
    this.closeButton = document.createElement('button');
    this.closeButton.className = 'btn-close shadow-none';
    this.closeButton.setAttribute('type', 'button');
    this.closeButton.setAttribute('data-bs-dismiss', 'alert');
    this.closeButton.setAttribute('aria-label', 'Close');
  }
}