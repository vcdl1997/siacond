import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-message',
  templateUrl: './message.component.html',
  styleUrls: ['./message.component.css']
})
export class MessageComponent {

  @Input() showMessage: Boolean = false;
  @Input() htmlMessage: string = "";

  constructor(){
  }
}
