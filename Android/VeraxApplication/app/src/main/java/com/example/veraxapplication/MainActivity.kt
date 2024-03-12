package com.example.veraxapplication

import android.os.Bundle
import android.view.Menu
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Row
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.MenuDefaults
import androidx.compose.material3.Scaffold
import androidx.compose.ui.graphics.Color
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.ui.res.colorResource
import androidx.compose.ui.tooling.preview.Preview

import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.Scaffold


class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            TopBarVerax()
        }
    }
}

//background = E6DFD9
// rouge = C34837

@OptIn(ExperimentalMaterial3Api::class)
@Preview
@Composable
fun TopBarVerax(){
    Row(
        modifier=Modifier.background(Color.White)
    ){

        Scaffold (
            topBar = {TopAppBar(
                title = { Text(text = "Verax", color = colorResource(R.color.red))},
            navigationIcon = {
                IconButton(onClick = { /* action() */ }) {
                    /*Icon(
                        imageVector = Icons.Filled.Menu,
                        contentDescription = "Economie"
                    )*/
                }
            },
            actions = {
                IconButton(onClick = { /* action() */ }) {
                    /*Icon(
                        imageVector = Icons.Filled.Favorite,
                        contentDescription = "Localized description"
                    )*/
                }
            }
            )}
        ){it
            Text(text = "coucou")
        }
    }
}