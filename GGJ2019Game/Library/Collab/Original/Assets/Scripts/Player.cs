using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Player : MonoBehaviour
{
    private Shape shape;
    public int homieNum = 0;
    public List<Shape> homies;
    public List<Cell> cells;
    public Score score;

    void Start()
    {
        shape = GetComponent<Shape>();
        GenerateCells();
    }

    void Update()
    {
        if(shape.loneliness > 99)
        {
            EventCenter.Emit("PlayerDie");
        }
        Debug.Log(homies.Count);
    }

    public void AddHomie(Shape homie)
    {
        DecreaseLoneliness(40);
        homieNum += 1;
        homies.Add(homie);
        score.rvalue += 100;
        Debug.Log("addHomie");
        foreach (Shape h in homies)
        {
            h.loneliness = Mathf.Max(h.loneliness - 40, 0);
        }
    }

    void DecreaseLoneliness(int num)
    {
        if (shape.loneliness < num)
        {
            shape.loneliness = 0;
        }
        else
        {
            shape.loneliness -= num;
        }
    }

    void GenerateCells()
    {
        cells = new List<Cell>();
        cells.Add(new Cell(2, 0, 0, false));
        cells.Add(new Cell(2, 0, 2, false));
        cells.Add(new Cell(0, 0, 2, false));
        cells.Add(new Cell(-2, 0, 2, false));
        cells.Add(new Cell(-2, 0, 0, false));
        cells.Add(new Cell(-2, 0, -2, false));
        cells.Add(new Cell(0, 0, -2, false));
        cells.Add(new Cell(2, 0, -2, false));
    }
}

public struct Cell
{
    public Vector3 position;
    public bool isEmpty;
    public Cell(float x, float y, float z, bool i)
    {
        position = new Vector3(x, y, z);
        isEmpty = i;
    }
}
