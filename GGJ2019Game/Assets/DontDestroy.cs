using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class DontDestroy : MonoBehaviour
{

    // Use for keeping playing the click sounds
    private void Awake()
    {
        GameObject[] bgm = GameObject.FindGameObjectsWithTag("Audio Source");
        if (bgm.Length > 1)
        {
            Destroy(this.gameObject);
        }
        DontDestroyOnLoad(this.gameObject);
    }
}