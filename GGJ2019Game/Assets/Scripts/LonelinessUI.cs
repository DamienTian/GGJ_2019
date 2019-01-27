using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class LonelinessUI : MonoBehaviour
{
    public Shape player;
    private Text text;
    // Start is called before the first frame update
    void Start()
    {
        text = GetComponent<Text>();
    }

    // Update is called once per frame
    void Update()
    {
        float pl = player.loneliness;
        text.text = "Loneliness: " + ((int)pl).ToString();
        text.color = new Color(pl / 100, (100 - pl) / 100, 0);
    }
}
