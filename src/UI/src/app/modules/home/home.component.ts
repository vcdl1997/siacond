import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent {
  condominiumId: any;

  constructor(private activatedRoute : ActivatedRoute) { }

  ngOnInit(): void {
    this.condominiumId = this.activatedRoute.snapshot.paramMap.get("id");
  }
}
