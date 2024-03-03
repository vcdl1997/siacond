import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-menubar',
  templateUrl: './menubar.component.html',
  styleUrls: ['./menubar.component.css']
})
export class MenubarComponent implements OnInit {

  @Input() showOptionsMenu = false;

  constructor() { }

  ngOnInit(): void {
  }

}
