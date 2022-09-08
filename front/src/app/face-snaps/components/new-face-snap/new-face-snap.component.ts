import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs";
import {FaceSnap} from "../../../core/models/face-snap.model";
import {map, tap} from "rxjs/operators";
import {FaceSnapsService} from "../../../core/services/face-snaps.service";
import {Router} from "@angular/router";
import {AuthService} from "../../../core/services/auth.service";

@Component({
  selector: 'app-new-face-snap',
  templateUrl: './new-face-snap.component.html',
  styleUrls: ['./new-face-snap.component.scss']
})
export class NewFaceSnapComponent implements OnInit {
  snapForm!: FormGroup;
  faceSnapProview$!:  Observable<FaceSnap>;
  urlRegex!:RegExp;
  user_id!:any;

  constructor(private  formBuilder: FormBuilder,
              private faceSnapsService: FaceSnapsService,
              private router:Router,
              private auth:AuthService) { }

  ngOnInit(): void {
    this.urlRegex = /(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)/;
    this.snapForm = this.formBuilder.group({
      title:[null,Validators.required],
      description: [null,Validators.required],
      imageUrl: [null,[Validators.required,Validators.pattern(this.urlRegex)]],
      location:[null]
    },{
      updateOn: 'blur' // formulaire mis a jours lorsqu'on change de champs
      }

      );

    this.faceSnapProview$ = this.snapForm.valueChanges.pipe(
      map(formValue => ({
        ...formValue,
        createdDate: new Date(),
        id:0,
        snaps:0
      }))
    );

    console.log(this.auth.userId);console.log('********** dans new post')
    this.user_id = localStorage.getItem('user_id');
  }

  // onSubmitForm():void{
  //   //console.log(this.snapForm.value);
  //   this.faceSnapsService.addFaceSnap(this.snapForm.value);
  //   this.router.navigateByUrl('/facesnaps');
  // }

  onSubmitForm():void{
     this.faceSnapsService.addFaceSnap(this.snapForm.value).pipe(
       tap(() => this.router.navigateByUrl('/facesnaps'))
     ).subscribe();
  }


  /**
   *  nouvelle enregistrement
   * @param title
   * @param description
   * @param photo
   * @param laDate
   * @param location
   */
  onSend(title:string,description:string,photo:string,laDate:string,location:string){
    const formData : FormData = new FormData();
    formData.append('title',title)
    formData.append('description',description)
    formData.append('photo',photo)
    formData.append('location',location)
    formData.append('laDate',laDate)
    formData.append('user_id',this.user_id)
    this.faceSnapsService.ajout(formData).subscribe(
      (res=>{
        console.log(res)
      })
    )
     this.router.navigateByUrl('/facesnaps');

  }
}
